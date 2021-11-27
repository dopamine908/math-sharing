import {ComponentFixture, TestBed} from '@angular/core/testing';

import {AdvancedPanelComponent} from './advanced-panel.component';

describe('AdvancedPanelComponent', () => {
  let component: AdvancedPanelComponent;
  let fixture: ComponentFixture<AdvancedPanelComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AdvancedPanelComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(AdvancedPanelComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
