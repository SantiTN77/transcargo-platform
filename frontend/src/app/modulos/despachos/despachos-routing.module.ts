import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { PaginaDespachoComponent } from './componentes/pagina-despacho/pagina-despacho.component';

const rutas: Routes = [
  {
    path: ':id',
    component: PaginaDespachoComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(rutas)],
  exports: [RouterModule],
})
export class DespachosRoutingModule {}

