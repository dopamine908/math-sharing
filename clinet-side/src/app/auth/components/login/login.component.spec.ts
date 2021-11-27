import {CommonModule} from '@angular/common';
import {ComponentFixture, TestBed} from '@angular/core/testing';
import {I18nModule} from 'src/app/i18n/i18n.module';
import {MaterialModule} from 'src/app/material/material.module';
import {GoogleLoginComponent} from '../google-login/google-login.component';

import {LoginComponent} from './login.component';

describe('LoginComponent', () => {
  let component: LoginComponent;
  let fixture: ComponentFixture<LoginComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [
        LoginComponent,
        GoogleLoginComponent
      ],
      imports: [
        CommonModule,
        MaterialModule,
        I18nModule,
      ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(LoginComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
function routes(routes: any): any {
  throw new Error('Function not implemented.');
}

