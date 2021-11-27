import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {AdvancedSearchComponent} from './components/advanced-search/advanced-search.component';
import {MaterialModule} from '../material/material.module';
import {FormsModule} from '@angular/forms';


@NgModule({
  declarations: [
    AdvancedSearchComponent
  ],
  imports: [
    CommonModule,
    MaterialModule,
    FormsModule
  ],
  exports:[
    AdvancedSearchComponent
  ]
})
export class AdvancedSearchModule { }
