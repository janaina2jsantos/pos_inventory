<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
	<!--brand-->
	<div class="brand flex-column-auto" id="kt_brand">
		<a href="#" class="brand-logo">
			<img alt="Logo" src="{{ asset('dist/assets/img/misc/logo02.png') }}" id="brandLogo" />
		</a>
		<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
			<span class="svg-icon svg-icon svg-icon-xl">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
						<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
					</g>
				</svg>
			</span>
		</button>
	</div>

	<!-- menu -->
	<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
		<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
			<ul class="menu-nav">
				<li class="menu-item menu-item-active" aria-haspopup="true">
					<a href="{{ route('dashboard') }}" class="menu-link">
						<span class="svg-icon menu-icon">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<polygon points="0 0 24 0 24 24 0 24" />
									<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
									<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
								</g>
							</svg>
						</span>
						<span class="menu-text">Dashboard</span>
					</a>
				</li>
				<li class="menu-section">
					<h4 class="menu-text">Navigation</h4>
					<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
				</li>
				
				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
									<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
								</g>
							</svg>
						</span>
						<span class="menu-text">Employees</span>
						<i class="fa-light fa-angle-right"></i>
					</a>
					<div class="menu-submenu">
						<ul class="menu-subnav">
							<li class="menu-item" aria-haspopup="true">
								<a href="{{ route('employees.index') }}" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">All Employees</span>
								</a>
							</li>
							<li class="menu-item" aria-haspopup="true">
								<a href="{{ route('employees.create') }}" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Add Employee</span>
								</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24"></rect>
									<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3"></path>
									<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000"></path>
								</g>
							</svg>
						</span>
						<span class="menu-text">Customers</span>
						<i class="fa-light fa-angle-right"></i>
					</a>
					<div class="menu-submenu">
						<ul class="menu-subnav">
							<li class="menu-item" aria-haspopup="true">
								<a href="{{ route('customers.index') }}" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">All Customers</span>
								</a>
							</li>
							<li class="menu-item" aria-haspopup="true">
								<a href="{{ route('customers.create') }}" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Add Customer</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				
				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24"></rect>
									<path d="M10,4 L21,4 C21.5522847,4 22,4.44771525 22,5 L22,7 C22,7.55228475 21.5522847,8 21,8 L10,8 C9.44771525,8 9,7.55228475 9,7 L9,5 C9,4.44771525 9.44771525,4 10,4 Z M10,10 L21,10 C21.5522847,10 22,10.4477153 22,11 L22,13 C22,13.5522847 21.5522847,14 21,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L21,16 C21.5522847,16 22,16.4477153 22,17 L22,19 C22,19.5522847 21.5522847,20 21,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000"></path>
									<rect fill="#000000" opacity="0.3" x="2" y="4" width="5" height="16" rx="1"></rect>
								</g>
							</svg>
						</span>
						<span class="menu-text">Suppliers</span>
						<i class="fa-light fa-angle-right"></i>
					</a>
					<div class="menu-submenu">
						<ul class="menu-subnav">
							<li class="menu-item" aria-haspopup="true">
								<a href="{{ route('suppliers.index') }}" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">All Suppliers</span>
								</a>
							</li>
							<li class="menu-item" aria-haspopup="true">
								<a href="{{ route('suppliers.create') }}" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Add Supplier</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				
				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24"></rect>
									<path d="M10,4 L21,4 C21.5522847,4 22,4.44771525 22,5 L22,7 C22,7.55228475 21.5522847,8 21,8 L10,8 C9.44771525,8 9,7.55228475 9,7 L9,5 C9,4.44771525 9.44771525,4 10,4 Z M10,10 L21,10 C21.5522847,10 22,10.4477153 22,11 L22,13 C22,13.5522847 21.5522847,14 21,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L21,16 C21.5522847,16 22,16.4477153 22,17 L22,19 C22,19.5522847 21.5522847,20 21,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000"></path>
									<rect fill="#000000" opacity="0.3" x="2" y="4" width="5" height="16" rx="1"></rect>
								</g>
							</svg>
						</span>
						<span class="menu-text">Advance Salaries</span>
						<i class="fa-light fa-angle-right"></i>
					</a>
					<div class="menu-submenu">
						<ul class="menu-subnav">
							<li class="menu-item" aria-haspopup="true">
								<a href="{{ route('advance-salaries.index') }}" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">All Advance Salaries</span>
								</a>
							</li>
							<li class="menu-item" aria-haspopup="true">
								<a href="{{ route('advance-salaries.create') }}" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Add Advance Salary</span>
								</a>
							</li>

							<li class="menu-item" aria-haspopup="true">
								<a href="{{ route('pay.salary') }}" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Pay Salary</span>
								</a>
							</li>

							<li class="menu-item" aria-haspopup="true">
								<a href="#" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Last Month Salary</span>
								</a>
							</li>
						</ul>
					</div>
				</li>




				<li class="menu-item" aria-haspopup="true">
					<a href="#" class="menu-link">
						<span class="svg-icon menu-icon">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
									<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
								</g>
							</svg>
						</span>
						<span class="menu-text">Builder</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>

