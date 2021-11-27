import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {I18nService} from './i18n.service';
import {HttpClient, HttpClientModule} from '@angular/common/http';
import {TranslateHttpLoader} from '@ngx-translate/http-loader';
import {TranslateLoader, TranslateModule} from '@ngx-translate/core';

export function HttpLoaderFactory(http: HttpClient) {
    return new TranslateHttpLoader(http);
}


@NgModule({
    declarations: [],
    imports: [
        CommonModule,
        HttpClientModule,
        TranslateModule.forRoot({
            defaultLanguage: 'zh',
            loader: {
                provide: TranslateLoader,
                useFactory: HttpLoaderFactory,
                deps: [HttpClient],
            }
        })
    ],
    providers: [
        I18nService
    ],
    exports: [
        TranslateModule
    ]
})
export class I18nModule {
}
