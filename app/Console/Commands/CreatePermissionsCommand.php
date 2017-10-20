<?php

namespace App\Console\Commands;

use App\Facade\PermissionReader;
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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Permission $permission)
    {
        parent::__construct();
        $this->permission = $permission;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $permissions = PermissionReader::getPermissions();
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
