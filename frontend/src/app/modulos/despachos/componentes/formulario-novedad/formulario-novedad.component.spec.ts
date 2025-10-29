import { ReactiveFormsModule } from '@angular/forms';
import { ComponentFixture, TestBed } from '@angular/core/testing';
import { FormularioNovedadComponent } from './formulario-novedad.component';

describe('FormularioNovedadComponent', () => {
  let component: FormularioNovedadComponent;
  let fixture: ComponentFixture<FormularioNovedadComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ReactiveFormsModule],
      declarations: [FormularioNovedadComponent],
    }).compileComponents();

    fixture = TestBed.createComponent(FormularioNovedadComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('crea el componente', () => {
    expect(component).toBeTruthy();
  });
});

