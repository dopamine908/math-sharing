import {Component, OnInit} from '@angular/core';
import {PanelControllerService} from '../../service/panel-controller.service';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.scss']
})
export class SearchComponent implements OnInit {
  advSearch = '';

  constructor(
    public panelService: PanelControllerService
  ) { }

  ngOnInit(): void {
  }

}
