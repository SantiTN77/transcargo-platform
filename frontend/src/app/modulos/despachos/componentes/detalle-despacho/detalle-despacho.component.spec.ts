import { ComponentFixture, TestBed } from '@angular/core/testing';
import { DetalleDespachoComponent } from './detalle-despacho.component';

describe('DetalleDespachoComponent', () => {
  let component: DetalleDespachoComponent;
  let fixture: ComponentFixture<DetalleDespachoComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [DetalleDespachoComponent],
    }).compileComponents();

    fixture = TestBed.createComponent(DetalleDespachoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('crea el componente', () => {
    expect(component).toBeTruthy();
  });
});
