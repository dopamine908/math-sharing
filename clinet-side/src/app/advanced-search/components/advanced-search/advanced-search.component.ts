import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';

@Component({
  selector: 'app-advanced-search',
  templateUrl: './advanced-search.component.html',
  styleUrls: ['./advanced-search.component.scss']
})
export class AdvancedSearchComponent implements OnInit {
  @Input() ngModel: any;
  @Output() ngModelChange = new EventEmitter();
  @Output() onClickAdvanced = new EventEmitter();
  constructor() { }

  ngOnInit(): void {
  }
  onChange(e:Event){
    console.log(this.ngModel)
    this.ngModelChange.emit(this.ngModel);
  }
  onClick(){
    this.onClickAdvanced.emit();
  }
}
