import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {LoginComponent} from './components/login/login.component';
import {RouterModule, Routes} from '@angular/router';
import {MaterialModule} from '../material/material.module';
import {GoogleLoginComponent} from './components/google-login/google-login.component';
import {I18nModule} from '../i18n/i18n.module';


const routes: Routes = [
  {
    path: '',
    component: LoginComponent
  }
];

@NgModule({
  declarations: [
    LoginComponent,
    GoogleLoginComponent
  ],
  imports: [
    CommonModule,
    MaterialModule,
    I18nModule,
    RouterModule.forChild(routes),
  ]
})
export class AuthModule { }
