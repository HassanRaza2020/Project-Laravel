@extends('layouts.app')
@section('title', 'Ask Answer')
@include('header.navbar')
@vite('resources/js/questions/answer-list.js')
@include('questions.ask-answer')
@include('questions.answers-list')