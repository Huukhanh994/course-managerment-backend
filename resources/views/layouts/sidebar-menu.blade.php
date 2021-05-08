<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Quản lý câu hỏi
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('questions.index')}}" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Quản lý câu hỏi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('answers.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Quản lý đáp án của câu hỏi</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item menu-open">
            <a href="{{ route('exams.index') }}" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Quản lý đề thi
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
        </li>
        <li class="nav-item  @if(Request::segment(1)=='subjects' ) active @endif">
            <a href="{{route('subjects.index')}}" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Môn học
                </p>
            </a>
        </li>
        <li class="nav-item @if(Request::segment(1)=='exam-structures' ) active @endif">
            <a href="{{route('exam_structures.index')}}" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Cơ cấu đề thi
                </p>
            </a>
        </li>
        <li class="nav-item  @if(Request::segment(1)=='questions' ) active @endif">
            <a href="{{route('questions.index')}}" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Ngân hàng câu hỏi
                </p>
            </a>
        </li>
        <li class="nav-item  @if(Request::segment(1)=='exams' ) active @endif">
            <a href="{{route('exams.index')}}" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Đề thi
                </p>
            </a>
        </li>
    </ul>
</nav>