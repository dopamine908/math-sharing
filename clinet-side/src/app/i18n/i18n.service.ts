import {Injectable} from '@angular/core';
import {TranslateService} from '@ngx-translate/core';

@Injectable()
export class I18nService {
  lang : string;
  constructor(translate: TranslateService) {
    this.lang = translate.getBrowserCultureLang();
    console.log(this)
  }
}
