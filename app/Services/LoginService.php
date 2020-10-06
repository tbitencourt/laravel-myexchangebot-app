<?php


namespace App\Services;


use App\Contracts\ChatbotActionRepository;
use App\Contracts\LoginService as LoginServiceContract;
use App\Models\ChatbotAction;

/**
 * Class LoginService
 * @package App\Services
 */
class LoginService implements LoginServiceContract
{
    /**
     * @var ChatbotActionRepository
     */
    private ChatbotActionRepository $repository;

    /**
     * LoginService constructor.
     * @param ChatbotActionRepository $repository
     */
    public function __construct(ChatbotActionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function startLogin(string $username): string
    {
        return $this->repository->startAction([
            'action_enum' => ChatbotAction::KEY_ACTION_LOGIN,
            'content' => ['username' => $username],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function endLogin(string $hash): string
    {
        $content = $this->repository->endAction($hash);
        return $content['username'];
    }
}
