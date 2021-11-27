import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {BoardComponent} from './components/board/board.component';
import {EditComponent} from './components/edit/edit.component';
import {ViewComponent} from './components/view/view.component';
import {RouterModule, Routes} from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: BoardComponent
  }
];

@NgModule({
  declarations: [
    BoardComponent,
    EditComponent,
    ViewComponent
  ],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
  ],
  exports:[
    EditComponent,
    ViewComponent
  ]
})
export class EditBoardModule { }
