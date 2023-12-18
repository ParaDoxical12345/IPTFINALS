<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\View;
class RolesandPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create(['name' => 'admin']);
        $role_employee = Role::create(['name' => 'employee']);

        $manage_payroll   = Permission::create (['name' =>'manage_payroll']);
        $read_payroll = Permission::create (['name' => 'read_payslip']);
        $add_employee = Permission::create (['name'=> 'add_employee']);
        $delete_employee = Permission::create (['name'=> 'delete_employee']);
        $edit_employee = Permission::create (['name'=> 'edit_employee']);
        $manage_position = Permission::create (['name'=> 'manage_position']);


        $permission_admin = [$add_employee,$delete_employee, $edit_employee, $manage_payroll ,$manage_position];
        $permission_employee = [$read_payroll];


        $role_admin->syncPermissions($permission_admin);
        $role_employee->syncPermissions($permission_employee);


        User::find(1)->assignRole($role_admin);
        User::find(2)->assignRole($role_employee);


        // Retrieve the "employee" and "specialEmployee" roles and pass their IDs to the view
        $employeeRole = Role::where('name', 'employee')->first();
        $specialEmployeeRole = Role::where('name', 'specialEmployee')->first();

        View::share([
            'employeeRoleId' => $employeeRole ? $employeeRole->id : null,
            'specialEmployeeRoleId' => $specialEmployeeRole ? $specialEmployeeRole->id : null,
        ]);

    }
}
