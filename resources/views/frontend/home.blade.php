@extends('frontend.layouts.app')
@section('title', 'LMS.lskit.com | Find your course')
@section('main_content')
<section>
        <div class="main-banner">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="content">
                                <h3>This is heading</h3>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as
                                    opposed to using 'Content here, content here'
                                </p>
                                <ul>
                                    <li>This is list</li>
                                    <li>This is list</li>
                                    <li>This is list</li>
                                </ul>
                                <a href="#" class="btn">This is Button</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form">
                                <h2>Registration</h2>
                                <form action="">
                                    <input class="form-control" type="text" name="" placeholder="First name">
                                    <input class="form-control" type="text" name="" placeholder="Last name">
                                    <input class="form-control" type="email" name="" placeholder="Email">
                                    <select class="form-select" aria-label="Default select example">
                                    <option selected>Select Course</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>
                                    <button class="btn">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection