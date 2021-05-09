<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
       
        <li class="nav-item @if(Request::segment(1)=='exams' ) menu-open @endif">
            <a href="{{ route('exams.index') }}" class="nav-link ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Quản lý đề thi
                    
                </p>
            </a>
        </li>
        <li class="nav-item  @if(Request::segment(1)=='subjects' ) menu-open @endif">
            <a href="{{route('subjects.index')}}" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Môn học
                </p>
            </a>
        </li>
        <li class="nav-item @if(Request::segment(1)=='exam-structures' ) menu-open @endif">
            <a href="{{route('exam_structures.index')}}" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Cơ cấu đề thi
                </p>
            </a>
        </li>
        <li class="nav-item  @if(Request::segment(1)=='questions' ) menu-open @endif">
            <a href="{{route('questions.index')}}" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Ngân hàng câu hỏi
                </p>
            </a>
        </li>
        <li class="nav-item  @if(Request::segment(1)=='answers' ) menu-open @endif">
            <a href="{{route('answers.index')}}" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Đáp án
                </p>
            </a>
        </li>
        <li class="nav-item  @if(Request::segment(1)=='exams' ) menu-open @endif">
            <a href="{{route('exams.index')}}" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Đề thi
                </p>
            </a>
        </li>
    </ul>
</nav>