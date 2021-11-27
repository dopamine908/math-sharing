import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {HeaderModule} from '../header/header.module';
import {MainComponent} from './components/main/main.component';
import {RouterModule, Routes} from '@angular/router';
import {SearchComponent} from './components/search/search.component';
import {MaterialModule} from '../material/material.module';
import {AdvancedSearchModule} from '../advanced-search/advanced-search.module';
import {AdvancedPanelComponent} from './components/advanced-panel/advanced-panel.component';
import {PanelControllerService} from './service/panel-controller.service';

const routes: Routes = [
  {
    path: '',
    component: MainComponent
  }
];

@NgModule({
  declarations: [
    MainComponent,
    SearchComponent,
    AdvancedPanelComponent
  ],
  imports: [
    CommonModule,
    HeaderModule,
    MaterialModule,
    AdvancedSearchModule,
    RouterModule.forChild(routes),
  ],
  providers: [
    PanelControllerService
  ]
})
export class MainModule { }
