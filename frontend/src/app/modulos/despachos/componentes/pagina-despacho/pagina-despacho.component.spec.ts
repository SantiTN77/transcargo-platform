import { NO_ERRORS_SCHEMA } from '@angular/core';
import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActivatedRoute, convertToParamMap } from '@angular/router';
import { BehaviorSubject, of } from 'rxjs';
import { PaginaDespachoComponent } from './pagina-despacho.component';
import { DespachosFachadaService } from '../../../../core/servicios/despachos-fachada.service';

describe('PaginaDespachoComponent', () => {
  let component: PaginaDespachoComponent;
  let fixture: ComponentFixture<PaginaDespachoComponent>;

  const despacho$ = new BehaviorSubject(null);
  const cargando$ = new BehaviorSubject(false);
  const error$ = new BehaviorSubject(null);

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PaginaDespachoComponent],
      providers: [
        {
          provide: DespachosFachadaService,
          useValue: {
            observarDespacho: () => despacho$.asObservable(),
            observarCargando: () => cargando$.asObservable(),
            observarError: () => error$.asObservable(),
            cargarDespacho: jasmine.createSpy('cargarDespacho'),
            registrarNovedad: jasmine.createSpy('registrarNovedad'),
            actualizarEstado: jasmine.createSpy('actualizarEstado'),
          },
        },
        {
          provide: ActivatedRoute,
          useValue: {
            paramMap: of(convertToParamMap({ id: '1' })),
          },
        },
      ],
      schemas: [NO_ERRORS_SCHEMA],
    }).compileComponents();

    fixture = TestBed.createComponent(PaginaDespachoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('crea el componente', () => {
    expect(component).toBeTruthy();
  });
});
