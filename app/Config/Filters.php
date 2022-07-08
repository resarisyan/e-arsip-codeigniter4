<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\FilterAuthSuperadmin;
use App\Filters\FilterAuthAdmin;
use App\Filters\FilterAuthUser;
use App\Filters\Cors;


class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'FilterAuthSuperadmin' => FilterAuthSuperadmin::class,
        'FilterAuthAdmin' => FilterAuthAdmin::class,
        'FilterAuthUser' => FilterAuthUser::class,
        'cors'          => Cors::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'FilterAuthSuperadmin' => ['except' => [
                'superadmin/auth', 'superadmin/auth/*',
                'login', 'login/*', '/',
            ]],
            'FilterAuthAdmin' => ['except' => [
                'login', 'login/*',
                'superadmin/auth', 'superadmin/auth/*', '/'
            ]],
            'FilterAuthUser' => ['except' => [
                'login', 'login/*',
                'superadmin/auth', 'superadmin/auth/*', '/'
            ]],
            'cors'
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'FilterAuthSuperadmin' => ['except' => [
                'superadmin/dashboard', 'superadmin/dashboard/*',
                'superadmin/kategori', 'superadmin/kategori/*',
                'superadmin/departemen', 'superadmin/departemen/*',
                'superadmin/user', 'superadmin/user/*',
                'superadmin/arsip', 'superadmin/arsip/*',
                'superadmin/auth/logout', 'superadmin/auth/logout/*', '/'
            ]],
            'FilterAuthAdmin' => ['except' => [
                'admin/dashboard', 'admin/dashboard/*',
                'admin/kategori', 'admin/kategori/*',
                'admin/user', 'admin/user/*',
                'admin/arsip', 'admin/arsip/*',
                'logout', 'logout/*', '/'
            ]],
            'FilterAuthUser' => ['except' => [
                'user/dashboard', 'user/dashboard/*',
                'user/arsip', 'user/arsip/*',
                'logout', 'logout/*', '/'
            ]],
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
