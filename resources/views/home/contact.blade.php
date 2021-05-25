@extends('layouts.main')

@section('title')
    This is Contact Title
@endsection

@section('content')
    
    @include('home.contacts.form1')

    <h1>
        Hello from2 Contact 
    </h1>
    <form action="">
        <input type="text" name="name" id="">
        <input type="email" name="email" id="">
        <input type="text" name="text" id="">
        <input type="text" name="text" id="">
        <input type="text" name="text" id="">
    </form>

    <h1>
        Hello from3 Contact 
    </h1>
    <form action="">
        <input type="text" name="name" id="">
        <input type="email" name="email" id="">
    </form>

    <h1>
        Hello from4 Contact 
    </h1>
    <form action="">
        <input type="text" name="name" id="">
        <input type="email" name="email" id="">
        <input type="text" name="text" id="">
    </form>

    <h1>
        Hello from5 Contact 
    </h1>
    <form action="">
        <input type="text" name="name" id="">
        <input type="email" name="email" id="">
        <input type="text" name="text" id="">
    </form>

    
@endsection