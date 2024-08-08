<?php

if (!function_exists('user')) {
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function user(): ?App\Models\User
    {
        return session()->get('user');
    }
}

if (!function_exists('canApprove')) {
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function canApprove(): array
    {
        return [\App\Models\User::prodi];
    }
}

if (!function_exists('canEdit')) {
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function canEdit(): array
    {
        return [\App\Models\User::adminprodi, \App\Models\User::superadmin];
    }
}

if (!function_exists('canDelete')) {
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function canDelete(): array
    {
        return [\App\Models\User::adminprodi, \App\Models\User::superadmin];
    }
}

if (!function_exists('canPrint')) {
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function canPrint(): array
    {
        return [\App\Models\User::adminprodi, \App\Models\User::superadmin, \App\Models\User::prodi];
    }
}

if (!function_exists('action_buttons')) {
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function action_buttons($route, $id): string
    {
        $user = user();
        $html = '';

        if (in_array($user->role, canEdit())) {
            $html .= '<a href="' . route($route.".edit", $id) . '" class="btn btn-sm btn-primary">Edit</a>';
        }

        if (in_array($user->role, canDelete())) {
            $html .= '<a href="' . route($route.".delete", $id) . '" class="btn btn-sm btn-danger">Delete</a>';
        }

        if (in_array($user->role, canApprove())) {
            $html .= '<a href="' . route($route.".approve", $id) . '" class="btn btn-sm btn-success">Approve</a>';
        }

        if (in_array($user->role, canPrint())) {
            $html .= '<input type="button" value="Print" onclick="window.print()" class="btn btn-dark">';
        }

        return $html;
    }
}

if (!function_exists('is_approved')) {
    function is_approved($is_approved): string
    {
        return $is_approved ? "✅" : "❌";
    }
}
