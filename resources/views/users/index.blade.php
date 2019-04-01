@extends('layouts.app')

@section('title')
	Usuaris
@endsection

@section('content')
	<v-container fluid>
		<v-layout>
			<v-flex>
				<users-list :users="{{ $users }}"></users-list>
			</v-flex>
		</v-layout>
	</v-container>
@endsection