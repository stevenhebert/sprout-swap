import{Component, OnInit} from "@angular/core";
import {Router} from "@angular/router";

import {Observable} from "rxjs/Observable"

import {Status} from "../class/status";

@Component({
	templateUrl: "./templates/sidenav-template.php"
})

export class SideNavComponent {
	status: Status = null;
	constructor(

	)
	{
	}

}