import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';

const routes: Routes = [
  {
    path: 'home',
    loadChildren:()=> import('./main/main.module').then(m => m.MainModule)
  },
  {
    path: 'login',
    loadChildren:()=> import('./auth/auth.module').then(m => m.AuthModule)
  },
  {
    path: 'edit',
    loadChildren: () => import('./edit-board/edit-board.module').then(m => m.EditBoardModule)
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
