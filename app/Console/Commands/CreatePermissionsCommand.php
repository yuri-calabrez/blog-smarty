<?php

namespace App\Console\Commands;

use App\Annotations\PermissionReader;
use App\Models\Permission;
use Illuminate\Console\Command;

class CreatePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acl:make-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating permissions based on controllers and actions';
    /**
     * @var Permission
     */
    private $permission;
    /**
     * @var PermissionReader
     */
    private $permissionReader;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Permission $permission, PermissionReader $permissionReader)
    {
        parent::__construct();
        $this->permission = $permission;
        $this->permissionReader = $permissionReader;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $permissions = $this->permissionReader->getPermissions();
        foreach ($permissions as $permission) {
            if(!$this->existsPermissions($permission)) {
                $this->permission->create($permission);
            }
        }

        $this->info('<info>Permissions loaded</info>');
    }

    private function existsPermissions($permission)
    {
        $permission = $this->permission->where([
            'name' => $permission['name'],
            'resource_name' => $permission['resource_name']
        ])->first();

        return $permission != null;
    }
}
