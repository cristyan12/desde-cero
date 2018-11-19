<?php

namespace Tests\Feature;

use App\Country;
use App\Journal;
use App\{Employee, Position, Profession, User};
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

        $bornCountry = $this->create(Country::class, [
            'name' => 'Venezuela'
        ]);

        $profession = $this->create(Profession::class, [
            'title' => 'Licenciado en administración'
        ]);

        $position = $this->create(Position::class, [
            'title' => 'Cajero'
        ]);

        $journalType = $this->create(Journal::class, [
            'type' => 'DIURNA'
        ]);

        $response = $this->actingAs($this->someUser())
            ->post(route('employees.store', [
                'name'              => 'Cristyan',
                'last_name'         => 'Valera',
                'document_identity' => '14996210',
                'country_id'        => $bornCountry->id,
                'born_date'         => '1981-12-21',
                'hire_date'         => '2012-09-28',
                'profession_id'     => $profession->id,
                'email'             => 'numenor21@mail.com',
                'cell_phone'        => '04120529549',
                'home_phone'        => '02572513137',
                'address'           => 'Guanare, barrio Buenos Aires, calle 3 via la cancha',
                'position_id'       => $position->id,
                'journal_type'      => $journalType->id
            ]))
            ->assertRedirect(route('employees.index'));

        $employee = Employee::first();

        $this->assertEquals(1, Employee::count(), 'No hay registros.');
        $this->assertSame('Cristyan', $employee->name);
        $this->assertSame('Valera', $employee->last_name);
        $this->assertSame('14996210', $employee->document_identity);
        $this->assertSame('Venezuela', $employee->country->name);
        $this->assertSame('1981-12-21', $employee->born_date);
        $this->assertSame('2012-09-28', $employee->hire_date);
        $this->assertSame('Licenciado en administración', $employee->profession->title);
        $this->assertSame('numenor21@mail.com', $employee->email);
        $this->assertSame('04120529549', $employee->cell_phone);
        $this->assertSame('02572513137', $employee->home_phone);
        $this->assertSame(
            'Guanare, barrio Buenos Aires, calle 3 via la cancha',
            $employee->address
        );
        $this->assertSame('Cajero', $employee->position->title);
        $this->assertSame('DIURNA', $employee->journal->type);
    }
}
