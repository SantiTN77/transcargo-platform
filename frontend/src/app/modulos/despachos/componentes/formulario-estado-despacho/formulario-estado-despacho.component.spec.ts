import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ReactiveFormsModule } from '@angular/forms';
import { FormularioEstadoDespachoComponent } from './formulario-estado-despacho.component';

describe('FormularioEstadoDespachoComponent', () => {
  let component: FormularioEstadoDespachoComponent;
  let fixture: ComponentFixture<FormularioEstadoDespachoComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [FormularioEstadoDespachoComponent],
      imports: [ReactiveFormsModule],
    }).compileComponents();

    fixture = TestBed.createComponent(FormularioEstadoDespachoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('crea el componente', () => {
    expect(component).toBeTruthy();
  });

  it('emite el estado seleccionado al enviar', () => {
    spyOn(component.actualizar, 'emit');
    component.formulario.patchValue({ estado: 'Entregado' });

    component.enviar();

    expect(component.actualizar.emit).toHaveBeenCalledWith('Entregado');
  });
});
