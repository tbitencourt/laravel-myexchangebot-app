<?php

namespace App\Actions\Chatbot;

use App\Contracts\ChatbotMessageTransfer as ChatbotMessageTransferContract;
use App\Contracts\LoginService as LoginServiceContract;
use App\Contracts\LoginUserValidator as LoginUserValidatorContract;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class LoginUserChatbotAction
 * @package App\Actions\Chatbot
 */
class LoginUserChatbotAction extends AbstractChatbotAction
{
    const KEY_ACTION = '@login';
    const RESPONSE_STEP1_MESSAGE_VALID = "Now input your password.";
    const RESPONSE_STEP2_MESSAGE_VALID = "Welcome back :username:! You logged successfully.";
    const RESPONSE_MESSAGE_INVALID = "Username invalid!";
    const KEY_PARAMETER_USERNAME = 1;
    /**
     * @var LoginUserValidatorContract
     */
    protected LoginUserValidatorContract $validator;
    /**
     * @var LoginServiceContract
     */
    protected LoginServiceContract $service;

    /**
     * @inheritDoc
     */
    public function __invoke(ChatbotMessageTransferContract $transfer): Collection
    {
        if ($this->getValidator()->isValid($transfer)) {
            return empty($transfer->getAction())
                ? $this->loginFirstStep($transfer)
                : $this->loginSecondStep($transfer);
        }
        return collect([
            'success' => false,
            'message' => __(self::RESPONSE_MESSAGE_INVALID)
        ]);
    }

    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return string
     */
    protected function extractUsername(ChatbotMessageTransferContract $transfer): string
    {
        $parameters = explode(" ", $transfer->getMessage());
        return Str::lower($parameters[self::KEY_PARAMETER_USERNAME]);
    }

    /**
     * @param string $username
     * @return string
     */
    protected function persistLoginAction(string $username): string
    {
        return $this->getService()->startLogin($username);
    }

    /**
     * @return LoginUserValidatorContract
     */
    public function getValidator(): LoginUserValidatorContract
    {
        $this->validator ??= app(LoginUserValidatorContract::class);
        return $this->validator;
    }

    /**
     * @return LoginServiceContract
     */
    public function getService(): LoginServiceContract
    {
        $this->service ??= app(LoginServiceContract::class);
        return $this->service;
    }

    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return Collection
     */
    protected function loginFirstStep(ChatbotMessageTransferContract $transfer): Collection
    {
        $username = $this->extractUsername($transfer);
        return collect([
            'actions' => [
                'action' => self::KEY_ACTION,
                'hash' => $this->persistLoginAction($username),
                'input_type' => 'password',
            ],
            'success' => true,
            'message' => self::RESPONSE_STEP1_MESSAGE_VALID,
        ]);
    }

    /**
     * @param ChatbotMessageTransferContract $transfer
     * @return Collection
     */
    protected function loginSecondStep(ChatbotMessageTransferContract $transfer): Collection
    {
        $email = $this->rememberUserName($transfer->getHash());
        $password = $transfer->getMessage();
        $credentials = compact('email', 'password');
        if (auth()->attempt($credentials)) {
            // Authentication passed...
            /** @var User $user */
            $user = auth()->user();
            return collect([
                'login' => [
                    'username' => $user->name,
                    'email' => $user->email,
                    'token' => $user->createToken('chatbot')->plainTextToken
                ],
                'success' => true,
                'message' => Str::replaceFirst(":username:", $user->name, self::RESPONSE_STEP2_MESSAGE_VALID),
            ]);
        }
        return collect([
            'success' => false,
            'message' => __(self::RESPONSE_MESSAGE_INVALID)
        ]);
    }

    /**
     * @param string $hash
     * @return string
     */
    protected function rememberUserName(string $hash): string
    {
        return $this->getService()->endLogin($hash);
    }
}
