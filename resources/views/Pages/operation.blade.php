@extends('layouts.app')

@section('content')

<section class="section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="icon-box-item text-center col-lg-4 col-md-6 mb-4">
				<div class="rounded shadow py-5 px-4">
					<div class="icon"> <i class="fas fa-user"></i>
					</div>
					<h3 class="mb-3">deposite Account</h3>
					<p class="mb-4">operations permettants d'ajourer de l'argent dans son compte</p> <a class="btn btn-sm btn-outline-primary" href="{{route('deposite')}}">View Details <i class="las la-arrow-right ms-1"></i></a>
				</div>
			</div>
			<div class="icon-box-item text-center col-lg-4 col-md-6 mb-4">
				<div class="rounded shadow py-5 px-4">
					<div class="icon"> <i class="fas fa-house-user"></i>
					</div>
					<h3 class="mb-3">withdraw Account</h3>
					<p class="mb-4">operations permettants de debiter de l'argent dans soncompte</p> <a class="btn btn-sm btn-outline-primary" href="{{route('withdraw')}}">View Details <i class="las la-arrow-right ms-1"></i></a>
				</div>
			</div>
			<div class="icon-box-item text-center col-lg-4 col-md-6 mb-4">
				<div class="rounded shadow py-5 px-4">
					<div class="icon"> <i class="fas fa-user-graduate"></i>
					</div>
					<h3 class="mb-3">Transfert</h3>
					<p class="mb-4">operations permettants d'envoyer de largent d'un compte a un autre </p> <a class="btn btn-sm btn-outline-primary" href="{{route('transfer')}}">View Details <i class="las la-arrow-right ms-1"></i></a>
				</div>
			</div>
			<div class="icon-box-item text-center col-lg-4 col-md-6 mb-4">
				<div class="rounded shadow py-5 px-4">
					<div class="icon"> <i class="fas fa-house-damage"></i>
					</div>
					<h3 class="mb-3">Logging</h3>
					<p class="mb-4">consulter tous vos transactions</p> <a class="btn btn-sm btn-outline-primary" href="service-details.html">View Details <i class="las la-arrow-right ms-1"></i></a>
				</div>
			</div>
			<div class="icon-box-item text-center col-lg-4 col-md-6 mb-4">
				<div class="rounded shadow py-5 px-4">
					<div class="icon"> <i class="fas fa-money-check-alt"></i>
					</div>
					<h3 class="mb-3">Notification</h3>
					<p class="mb-4">Consulter toutes vos notifications</p> <a class="btn btn-sm btn-outline-primary" href="service-details.html">View Details <i class="las la-arrow-right ms-1"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>


@endsection
