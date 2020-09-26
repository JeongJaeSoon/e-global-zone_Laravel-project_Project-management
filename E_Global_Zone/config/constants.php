<?php

return [
    'uri' => [
        'main' => 'http://gzone.yjuweb.org/',
        'admin' => 'http://gzone.yjuweb.org/admin',
        'reset' => 'http://gzone.yjuweb.org/api/reset',
    ],
    'kor' => [
        'access' => [
            'admin' => '관리자만 접근 할 수 있습니다.',
        ],
        'dept' => [
            'index' => [
                'success' => '계열/학과 목록 조회에 성공하였습니다.',
                'failure' => '계열/학과 목록 조회에 실패하였습니다.',
                'no_value' => '등록된 계열/학과가 없습니다.'
            ],
            'store' => [
                'success' => '(을)를 계열/학과 목록에 추가하였습니다.',
                'failure' => '계열/학과 추가에 실패하였습니다.',
            ],
            'update' => [
                'success' => '(으)로 계열/학과 이름을 변경하였습니다.',
                'failure' => '계열/학과 이름 변경에 실패하였습니다.',
            ],
            'destroy' => [
                'success' => '(을)를 계열/학과 목록에서 삭제하였습니다.',
                'failure' => '계열/학과 삭제에 실패하였습니다.',
            ]
        ],
        'std_for' => [
            'store' => [
                'success' => '(을)를 유학생 목록에 추가하였습니다.',
                'failure' => '유학생 추가에 실패하였습니다.'
            ],
            'update' => [
                'success' => '유학생 정보 변경에 성공하였습니다.',
                'failure' => '유학생 정보 변경에 실패하였습니다.'
            ],
            'destroy' => [
                'success' => '(을)를 유학생 목록에서 삭제하였습니다.',
                'failure' => '유학생 삭제에 실패하였습니다.'
            ],
            'passwordinit' => [
                'success' => '비밀번호 초기화에 성공하였습니다.',
                'failure' => '비밀번호 변경에 실패하였습니다.'
            ],
            'favorite' => [
                'success' => '유학생 즐겨찾기 변경에 성공하였습니다.',
                'failure' => '유학생 즐겨찾기 변경에 실패하였습니다.'
            ]
        ],
        'std_for_contacts' => [
            'index' => [
                'success' => '선택한 유학생에 대한 연락처 정보 조회에 성공하였습니다.',
                'failure' => '유학생 연락처 정보 조회에 실패하였습니다.',
                'no_value' => '선택한 유학생에 대한 연락처 정보가 없습니다.'
            ]
        ],
        'work_std_for' => [
            'index' => [
                'success' => '의 근로유학생 목록 조회에 성공하였습니다.',
                'failure' => '근로유학생 목록 조회에 실패하였습니다.',
                'no_value' => '에 등록된 근로유학생이 없습니다.'
            ],
            'store' => [
                'success' => '의 근로유학생 목록 추가에 성공하였습니다.',
                'failure' => '근로유학생 목록 추가에 실패하였습니다.',
            ],
            'destroy' => [
                'success' => '의 근로유학생 목록에서 삭제되었습니다.',
                'failure' => '근로유학생 목록 삭제에 실패하였습니다.',
            ]
        ],
        'not_work_std_for' => [
            'index' => [
                'success' => '의 미등록 유학생 목록 조회에 성공하였습니다.',
                'failure' => '미등록 유학생 목록 조회에 실패하였습니다.',
            ]
        ],
        'std_kor' => [
            'index_approval' => [
                'success1' => '가입 승인 대기중인 한국인 학생은 ',
                'success2' => '명입니다.',
                'no_value' => '가입 승인 대기중인 한국인 학생이 없습니다.'
            ],
            'update_approval' => [
                'success' => '명의 한국인 학생이 가입 승인 되었습니다.',
                'failure' => '가입 승인에 실패하였습니다. 한국인 학생 다시 목록을 확인해주세요.'
            ],
            'index' => [
                'success' => '한국인 학생 정보 조회에 성공하였습니다.',
                'failure' => '한국인 학생 정보 조회에 실패하였습니다.',
                'no_value' => '해당 학생의 정보가 없습니다.'
            ],
            'store' => [
                'success' => '가입 신청에 성공하였습니다. 글로벌 존 관리자 승인 시 이용가능합니다.',
                'failure' => '가입 신청에 실패하였습니다. 글로벌 존 관리자에게 문의해주세요.'
            ],
            'destroy' => [
                'success' => '(을)를 한국인학생 목록에서 삭제하였습니다.',
                'failure' => '한국인학생 삭제에 실패하였습니다.'
            ],
            'passwordinit' => [
                'success' => '비밀번호 초기화에 성공하였습니다.',
                'failure' => '비밀번호 변경에 실패하였습니다.'
            ],
            'favorite' => [
                'success' => '유학생 즐겨찾기 변경에 성공하였습니다.',
                'failure' => '유학생 즐겨찾기 변경에 실패하였습니다.'
            ]
        ],
        'login' => [
            'log_in' => [
                'success' => ' 님 로그인되었습니다.',
                'failure' => '로그인에 실패하였습니다.',
                'wrong_value' => '아이디 또는 비밀번호를 다시 확인하세요.',
                'no_permission' => '관리자 승인 후 서비스 이용이 가능합니다.',
                'no_g_suite' => 'G-Suite 계정이 아닙니다.',
                'no_access' => '회원 가입 후 이용 가능합니다.',
                'has_restrict' => '이용제한 학생으로 사용할 수 없습니다.',
            ],
            'log_out' => [
                'success' => '로그아웃되었습니다.',
                'failure' => '로그아웃에 실패하였습니다.',
            ]
        ],
        'data_export' => [
            'dept' => '계열, 학과 목록.xlsx',
            'std_kor' => '글로벌 존 이용 학생 목록.xlsx',
            'std_for' => '글로벌 존 유학생 목록.xlsx',
            'work_std_for' => '글로벌 존 근로 유학생 목록.xlsx',
            'failure' => '엑셀 파일 출력에 실패하였습니다.'
        ],
        'result_img' => [
            'index' => [
                'success' => '이미지 로딩에 성공하였습니다.',
                'failure' => '이미지 로딩에 실패하였습니다. ( 이미지 파일이 손상되었거나 일시적인 오류입니다 )'
            ]
        ],
        'reservation' => [
            'kor_store' => [
                'success' => '일 스케줄 예약이 성공하였습니다.',
                'failure' => '예약 불가능한 스케줄입니다.',
                'duplicate' => '이미 예약한 스케줄입니다.',
                'over_count' => '1일 최대 스케줄 예약 횟수를 초과하였습니다.',
                'same_time' => '같은 시간대의 스케줄은 예약이 불가능합니다.',
                'over_people' => '해당 스케줄은 정원 초과로 예약에 실패하였습니다.',
            ],
            'kor_index' => [
                'success' => '예약한 스케줄 조회에 성공하였습니다.',
                'failure' => '스케줄 예약 목록 조회에 실패하였습니다.',
                'no_value' => '예약된 스케줄이 없습니다.'
            ],
            'kor_show_rank' => [
                'success' => '학기의 랭킹을 반환합니다.'
            ],
            'kor_show_sect' => [
                'success' => ' 학기별 미팅 목록 조회에 성공하였습니다.',
                'failure' => ' 학기별 미팅 목록 조회에 실패하였습니다.',
            ],
            'for_index' => [
                'success' => '스케줄 목록 조회에 성공하였습니다.',
                'failure' => '스케줄에 대한 예약 목록이 없습니다.'
            ],
            'for_show_kor_list' => [
                'success' => '스케줄 예약 학생 명단 조회에 성공하였습니다.',
                'failure' => '신청한 학생이 없습니다.'
            ],
            'for_update_permission' => [
                'success' => '스케줄 예약 학생 승인결과 업데이트를 성공하였습니다.',
                'failure' => '스케줄 예약 학생 승인결과 업데이트에 실패하였습니다.'
            ],
            'for_input_result' => [
                'success' => '스케줄 출석 결과 입력을 성공하였습니다.',
                'failure' => '스케줄 출석 결과 입력에 실패하였습니다.',
                'completed' => '이미 결과 입력이 완료되어 수정 불가능합니다.'
            ],
            'admin_add_kor' => [
                'success' => '일 스케줄 예약이 성공하였습니다.',
                'failure' => '스케줄 예약에 실패하였습니다.',
                'duplicate' => '이미 예약한 스케줄입니다.'
            ],
            'destroy' => [
                'success' => '예약한 스케줄이 삭제되었습니다.',
                'failure' => '예약한 스케줄 삭제에 실패하였습니다.',
                'over_date' => '예약 취소 가능 일자를 초과했습니다.'
            ],
        ],
        'restrict' => [
            'index' => [
                'success' => ' 학생의 이용 제한 사유 조회가 완료되었습니다.',
                'failure' => '이용 제한 정보 조회에 실패하였습니다.'
            ],
            'store' => [
                'success' => ' 학생의 이용 제한 등록이 완료되었습니다.',
                'failure' => '이미 이용 제한된 학생입니다.',
                'section_err' => '학기 전체 제한은 학기가 시작한 후 이용 가능합니다.'
            ],
            'update' => [
                'success' => ' 학생의 이용 제한 해제가 완료되었습니다.'
            ]
        ],
        'schedule' => [
            'show' => [
                'success' => '스케줄 목록 조회에 성공하였습니다.',
                'failure' => '스케줄 목록 조회에 실패하였습니다.',
            ],
            'store' => [
                'success' => '스케줄 등록을 완료하였습니다.',
                'failure' => '스케줄 등록에 실패하였습니다.',
                'section_err' => '학기가 시작된 이후부터는 스케줄 등록이 불가능합니다. 개별 입력을 이용해주세요.',
            ],
            'update' => [
                'success' => '스케줄 변경를 완료하였습니다.',
                'failure' => '스케줄 변경에 실패하였습니다.',
            ],
            'destroy' => [
                'success' => '스케줄 삭제을 완료하였습니다.',
                'failure' => '스케줄 삭제에 실패하였습니다.',
                'no_value' => '해당 날짜에 스케줄이 없습니다.',
            ],
            'index_uninputed_list' => [
                'success' => ' 일 출석 결과 미입력건 조회에 성공하였습니다.',
            ],
            'index_approved_list' => [
                'success' => ' 일 출석 결과 미승인건을 반환합니다.',
                'failure' => ' 일자 유학생 스케줄을 조회에 실패하였습니다.'
            ],
            'update_approved_list' => [
                'success' => '출석 결과 승인이 완료되었습니다.',
                'failure' => '출석 결과 승인에 실패하였습니다.',
                'duplicate' => '이미 출석 승인된 완료된 스케줄입니다.',
            ],
            'kor_index' => [
                'success' => '일정 조회를 성공하였습니다.',
                'failure' => '등록된 스케줄이 없습니다.'
            ]
        ]
    ]

];
