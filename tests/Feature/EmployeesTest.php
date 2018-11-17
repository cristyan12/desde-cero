<?php

namespace Tests\Feature;

use App\Profession;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_loads_the_lists_of_employees()
    {
        $response = $this->actingAs($this->someUser())
            ->get(route('employees.index'))
            ->assertStatus(200)
            ->assertViewIs('employees.index')
            ->assertViewHas('employees')
            ->assertSee('Empleados');
    }

    /** @test */
    function it_loads_the_new_employee_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->someUser())
            ->get(route('employees.create'))
            ->assertStatus(200)
            ->assertViewIs('employees.create')
            ->assertSee('Nuevo Empleado');
    }

    /** @test */
    function it_show_a_default_message_when_list_of_employees_is_empty()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->someUser())
            ->get(route('employees.index'))
            ->assertStatus(200)
            ->assertSee('No hay empleados registrados aún.');
    }

    /** @test */
    function a_user_can_create_a_employee()
    {
        $this->withoutExceptionHandling();

        $profession = $this->create(Profession::class, [
            'title' => 'Licenciado en administración'
        ]);

        $response = $this->actingAs($this->someUser())
            ->post(route('employees.store', [
                'name'              => 'NOMBRE_EMPLEADO',
                'last_name'         => 'APELLIDO_EMPLEADO',
                'document_identity' => '14996210',
                'profession_id'     => $profession->id,
                'cell_phone'        => '04120529549',
                'home_phone'        => '02572513131',
                'position'          => 'Cajero'
            ]))
            ->assertRedirect(route('employees.index'));

        $employee = Employee::first();
        $this->assertSame(1, $employee->count());
        $this->assertSame('Cristyan', $employee->name);
        $this->assertSame('Valera', $employee->last_name);
        $this->assertSame('14996210', $employee->document_identity);
        $this->assertSame('Licenciado en administración', $employee->profession->name);
        $this->assertSame('Cajero', $employee->position->name);
    }
}
