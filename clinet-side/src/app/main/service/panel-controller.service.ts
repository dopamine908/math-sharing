import {Injectable} from '@angular/core';

@Injectable()
export class PanelControllerService {
  isAdvanedPanel: boolean = false;
  constructor() { }
  openAdvanedPanel(){
    this.isAdvanedPanel = !this.isAdvanedPanel;
  }
}
