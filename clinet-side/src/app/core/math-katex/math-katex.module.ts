import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {KatexModule} from 'ng-katex';


@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    KatexModule
  ],
  exports: [
    KatexModule
  ]
})
export class MathKatexModule { }
