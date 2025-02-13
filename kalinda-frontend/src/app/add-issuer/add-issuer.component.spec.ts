import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AddIssuerComponent } from './add-issuer.component';

describe('AddIssuerComponent', () => {
  let component: AddIssuerComponent;
  let fixture: ComponentFixture<AddIssuerComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [AddIssuerComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AddIssuerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
