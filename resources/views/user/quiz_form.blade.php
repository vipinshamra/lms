@extends('layouts.user')
@section('content')

<style>
    #timer {
        font-size: 1.5rem;
        color: red;
    }
</style>    
<div class="dashboard-body">
    <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="#" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Quiz Form</span></li>
</ul>
</div>
<!-- Breadcrumb End -->

 <!-- Course Tab Start -->
 <div class="card">
    <div class="card-body">
        <div class="mb-20 flex-between flex-wrap gap-8">
            <h3 class="mb-0">Quiz</h3>
            <div class="flex-align gap-8 flex-wrap">
                
                <div class="position-relative text-gray-500 flex-align gap-4 text-13">
                    {{-- <span class="text-inherit">Sort by: </span> --}}
                    <div id="timer">Time Left: <span id="time">60</span> seconds</div>
                </div>
            </div>
        </div>

        <form action="#">
            <div class="row gy-20">
            
                <div class="container mt-5">
                    <div id="quiz" class="mt-4">
                        <!-- Quiz questions will be injected here -->
                    </div>
                    <div class="text-center mt-4">
                        <button id="prevBtn" class="btn btn-secondary rounded-pill py-9" disabled>Previous</button>
                        <button id="nextBtn" class="btn btn-primary rounded-pill py-9">Next</button>
                   
                    </div>
                </div>
      
            </div>
        </form>

    </div>
</div>
<!-- Course Tab End -->

</div>
   

@section('scripts')
<script>
    // let questions = [];

    // var url= "{{ route('user.quiz.getquestion',$details->course->id) }}";
    // fetch("{{ route('user.quiz.getquestion',$details->course->id) }}")
    // .then(response => response.json())
    // .then(data => {
    
    //      questions  = data;

    //     // Do something with the quiz questions array
    //     console.log(questions);
    // })
    // .catch(error => console.error(error));

    const questions = [
        { question: "What is 2 + 2?", answers: ["3", "4", "5"], correct: 1 },
        { question: "What is the capital of France?", answers: ["Berlin", "Madrid", "Paris"], correct: 2 },
        { question: "What is 5 * 6?", answers: ["30", "35", "40"], correct: 0 },
    ];

    let currentQuestion = 0;
    let timer;

    function showQuestion() {
        const question = questions[currentQuestion];
        $('#quiz').html(`
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">${question.question}</h5>
                    ${question.answers.map((answer, index) => `
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer" value="${index}" id="answer${index}">
                            <label class="form-check-label" for="answer${index}">${answer}</label>
                        </div>
                    `).join('')}
                </div>
            </div>
        `);

        $('#prevBtn').prop('disabled', currentQuestion === 0);
        $('#nextBtn').text(currentQuestion === questions.length - 1 ? 'Finish' : 'Next');
    }

    function startTimer() {
        let timeLeft = 60;
        $('#time').text(timeLeft);
        
        timer = setInterval(() => {
            timeLeft--;
            $('#time').text(timeLeft);
            if (timeLeft <= 0) {
                clearInterval(timer);
                alert("Time's up!");
                // Handle the end of the quiz here
            }
        }, 1000);
    }

    $('#nextBtn').click(() => {
        if (currentQuestion < questions.length - 1) {
            currentQuestion++;
            showQuestion();
        } else {
            clearInterval(timer);
            alert("Quiz finished!"); // Handle quiz completion here
        }
    });

    $('#prevBtn').click(() => {
        if (currentQuestion > 0) {
            currentQuestion--;
            showQuestion();
        }
    });

    $(document).ready(() => {
        showQuestion();
        startTimer();
    });
</script>
@endsection

@endsection