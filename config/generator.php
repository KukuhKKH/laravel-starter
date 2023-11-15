<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Limit generate table
    |--------------------------------------------------------------------------
    |   ['table-1', 'table-2', 'table-n']
    */
    'only'    => [],

    /*
    |--------------------------------------------------------------------------
    | Table to exclude
    |--------------------------------------------------------------------------
    |   ['failed_jobs', 'migrations', 'password_resets']
    */
    'except'  => [
        '_*',
        'clockwork',
        'failed_jobs',
        'job_batches',
        'jobs',
        'migrations',
        'password_reset_tokens',
        'personal_access_tokens',
    ],

    /*
    |--------------------------------------------------------------------------
    | Eloquent Model Default Configuration
    |--------------------------------------------------------------------------
    */
    'model'   => [
        'path'    => [
            /*
            |--------------------------------------------------------------------------
            | Path to existing file to be use as reference
            |--------------------------------------------------------------------------
            | false = don't load existing model
            | null  = load from App/Models
            | other path = load from there
            */
            'reference' => false,

            /*
            |--------------------------------------------------------------------------
            | Path to save resulting file
            |--------------------------------------------------------------------------
            | null = save to storage
            | other path = save to there
            */
            'result'    => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | Limit generate model file
        |--------------------------------------------------------------------------
        |   ['table-1', 'table-2', 'table-n']
        */
        'only'    => [],

        /*
        |--------------------------------------------------------------------------
        | Table to exclude
        |--------------------------------------------------------------------------
        |   ['failed_jobs', 'migrations', 'password_resets']
        */
        'except'  => [],

        /*
        |--------------------------------------------------------------------------
        | Default Configuration
        |--------------------------------------------------------------------------
        |   [
        |       'namespace'          => 'App\Models',
        |       'abstract'           => false,
        |       'prefix'             => '',
        |       'cast' => [
        |           'fld_*'          => 'date:Y-m-d',
        |           'field'          => 'date:H:i:s',
        |       ],
        |       'fill_key'           => false,
        |       'where_field'        => true,
        |       'relation_docstring' => true,
        |       'trait'              => [],
        |   ]
        */
        'default' => [
            'fill_key'           => true,
            'where_field'        => false,
            'relation_docstring' => false,
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | GraphQL Default Configuration
    |--------------------------------------------------------------------------
    */
    'graphql' => [
        'path'    => [
            /*
            |--------------------------------------------------------------------------
            | Path to save resulting file
            |--------------------------------------------------------------------------
            | null = save to storage
            | other path = save to there
            */
            'result' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | Limit generate json api file
        |--------------------------------------------------------------------------
        |   ['table-1', 'table-2', 'table-n']
        */
        'only'    => [],

        /*
        |--------------------------------------------------------------------------
        | Table to exclude
        |--------------------------------------------------------------------------
        |   ['failed_jobs', 'migrations', 'password_resets']
        */
        'except'  => [],

        /*
        |--------------------------------------------------------------------------
        | Default Configuration
        |--------------------------------------------------------------------------
        */
        'default' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Grammer configuration override
    |--------------------------------------------------------------------------
    | <singular> = <plural> : Custom mapping (default use Str::singular and Str::singular)
    */
    'plural'  => [],

    /*
    |--------------------------------------------------------------------------
    | Table configuration override
    |--------------------------------------------------------------------------
    | <table-name>.class : Class name (default use Str::studly(table))
    |
    | <table-name>.model.base : Base used for model, can be string or array
    |   - string : 'Illuminate\Database\Eloquent\Model'
    |   - array  : ['Illuminate\Foundation\Auth\User']
    |     => use Illuminate\Foundation\Auth\User
    |     => extends User
    |   - array  : ['Illuminate\Foundation\Auth\User', 'Authenticatable']
    |     => use Illuminate\Foundation\Auth\User as Authenticatable
    |     => extends Authenticatable
    |   - array  : ['Illuminate\Foundation\Auth\User', 'User\Authenticatable']
    |     => use Illuminate\Foundation\Auth\User
    |     => extends User\Authenticatable
    |   - array  : ['Illuminate\Foundation\Auth\User', 'Usr\Authenticatable']
    |     => use Illuminate\Foundation\Auth\User as Usr
    |     => extends Usr\Authenticatable
    |
    | <table-name>.model.abstract : Mark model as an abstract
    | <table-name>.model.prefix : Add prefix to model name
    |
    | <table-name>.model.const : Dump table content as class const
    | <table-name>.model.const.0 : Field to be use as value of const
    | <table-name>.model.const.1 : Field to be use as const names
    |
    | <table-name>.model.cast : Override column type
    | <table-name>.model.cast.<column> : String to use as column type
    |
    | <table-name>.model.fill_key : Boolean, if true primary key will included in fillable
    | <table-name>.model.where_field : Boolean, if true docstring for where magic method will generated
    | <table-name>.model.relation_docstring : Boolean, trus = use docstring to mark relation method return type, false = use type hint
    |
    | <table-name>.model.trait : Add trait use to model
    | <table-name>.model.trait.0 : Trait to be use, can be string or array as in <table-name>.model.base
    |
    |
    | <table-name>.jsonapi.child_data : Include child table in related field, default only parent table
    | <table-name>.jsonapi.child_data.0 : Child table name
    | <table-name>.jsonapi.child_data.<...> : Any other child table name
    */
    'options' => [
        'users' => [
            'model' => [
                'base'  => ['Illuminate\Foundation\Auth\User', 'Authenticatable'],
                'trait' => [
                    'Yajra\Auditable\AuditableWithDeletesTrait',
                    'Laravel\Sanctum\HasApiTokens',
                    'Illuminate\Database\Eloquent\Factories\HasFactory',
                    'Illuminate\Notifications\Notifiable',
                    'Illuminate\Database\Eloquent\SoftDeletes',
                ],
            ],
        ],
    ],
];
