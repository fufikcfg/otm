<?php

namespace App\Roles\Domain\Enum;

use App\Shared\Application\Enum\EnumAbstract;

class RoleEnum extends EnumAbstract
{
    const string DEVELOPER = 'Разработчик';
    const string DESIGNER = 'Дизайнер';
    const string MANAGER = 'Менеджер';
    const string ADMIN = 'Администратор';
    const string NO_ROLE = 'Нет роли';
}