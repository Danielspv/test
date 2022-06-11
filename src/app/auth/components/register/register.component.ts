import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss'],
})
export class RegisterComponent implements OnInit {
  registerForm!: FormGroup;
  public loading: boolean;

  constructor(private fb: FormBuilder) {
    this.createForm();
    this.loading = false;
  }

  ngOnInit(): void {}

  private createForm() {
    this.registerForm = this.fb.group({
      email: ['', [Validators.required, Validators.email]],
      username: ['', [Validators.required, Validators.minLength(2)]],
      password: ['', Validators.required],
      passwordCheck: ['', Validators.required],
    });
  }
}
