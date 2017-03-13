//this is the modal that pops up when "sign-in" is clicked

import{Component, ViewChild, EventEmitter, Output} from "@angular/core";

import {Router} from "@angular/router";
import {Observable} from "rxjs/Observable"
import {Status} from "../class/status";
import {SignInService} from "../service/signin-service";
import {SignIn} from "../class/signin-class";
declare var $: any;

@Component({
	templateUrl: "./templates/signin-template.php",
	selector: "signin-component"
})

export class SignInComponent {
	@ViewChild("signInForm") signInForm : any;

	signin: SignIn = new SignIn("", "");
	status: Status = null;

	constructor(private SignInService: SignInService, private router: Router){}


	signIn() : void {
		this.SignInService.postSignIn(this.signin)
			.subscribe(status => {
				this.status = status;
				if(status.status === 200) {
					this.router.navigate([""]);
					this.signInForm.reset();
					setTimeout(function(){$("#signin-modal").modal('hide');},1000);
				} else{
					console.log(status.status);
					console.log(this.signin);
				}
			});
	}
}