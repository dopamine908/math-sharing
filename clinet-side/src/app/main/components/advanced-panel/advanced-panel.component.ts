import {Component, OnInit} from '@angular/core';

@Component({
  selector: 'app-advanced-panel',
  templateUrl: './advanced-panel.component.html',
  styleUrls: ['./advanced-panel.component.scss']
})
export class AdvancedPanelComponent implements OnInit {
  public list: AdvancedModel[]=[
    {
      name: "國中數學",
      children: []
    },
    {
      name:"高中數學",
      children:[]
    },
    {
      name: "負數",
      children: [{
        name: "負數的意義"
      }]
    },
    {
      name: "數線與幾何",
      children: [{
        name: "幾何學",
        children:[
          {
            name:"畢氏定理"
          }
        ]
      }]
    },
    {
      name: "數線與幾何",
      children: [{
        name: "幾何學",
        children: [
          {
            name: "畢氏定理"
          }
        ]
      }]
    },
    {
      name: "數線與幾何",
      children: [{
        name: "幾何學",
        children: [
          {
            name: "畢氏定理"
          }
        ]
      }]
    },
    {
      name: "數線與幾何",
      children: [{
        name: "幾何學",
        children: [
          {
            name: "畢氏定理"
          }
        ]
      }]
    }
  ];
  constructor() { }

  ngOnInit(): void {
  }

}
class AdvancedModel {
  public name!: string;
  public children?: AdvancedModel[];
}
