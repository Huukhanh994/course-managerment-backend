<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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