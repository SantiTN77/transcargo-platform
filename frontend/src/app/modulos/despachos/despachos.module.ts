import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { DetalleDespachoComponent } from './componentes/detalle-despacho/detalle-despacho.component';
import { FormularioEstadoDespachoComponent } from './componentes/formulario-estado-despacho/formulario-estado-despacho.component';
import { FormularioNovedadComponent } from './componentes/formulario-novedad/formulario-novedad.component';
import { PaginaDespachoComponent } from './componentes/pagina-despacho/pagina-despacho.component';
import { DespachosRoutingModule } from './despachos-routing.module';

@NgModule({
  declarations: [
    PaginaDespachoComponent,
    DetalleDespachoComponent,
    FormularioNovedadComponent,
    FormularioEstadoDespachoComponent,
  ],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    DespachosRoutingModule,
  ],
})
export class DespachosModule {}

