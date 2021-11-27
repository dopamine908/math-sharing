import {NgModule} from '@angular/core';
import {FormsModule} from '@angular/forms';
import {BrowserModule} from '@angular/platform-browser';
import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {I18nModule} from './i18n/i18n.module';
import {MathKatexModule} from './core/math-katex/math-katex.module';

@NgModule({
    declarations: [
        AppComponent
    ],
    imports: [
        BrowserModule,
        FormsModule,
        I18nModule,
        AppRoutingModule,
        MathKatexModule
    ],
    providers: [],
    bootstrap: [AppComponent]
})
export class AppModule {
}
