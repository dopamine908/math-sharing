import {TestBed} from '@angular/core/testing';

import {PanelControllerService} from './panel-controller.service';

describe('PanelControllerService', () => {
  let service: PanelControllerService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(PanelControllerService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
