import {Component, OnInit} from '@angular/core';
import {PanelControllerService} from '../../service/panel-controller.service';

@Component({
  selector: 'app-main',
  templateUrl: './main.component.html',
  styleUrls: ['./main.component.scss']
})
export class MainComponent implements OnInit {

  constructor(
    public panelService: PanelControllerService
  ) { }

  ngOnInit(): void {
  }

}
