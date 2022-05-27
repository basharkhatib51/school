<?php

namespace App\Http\Resources\Student;

use App\Http\Resources\Generated\PaymentResource;
use App\Http\Resources\Permission\PermissionResource;
use App\Http\Resources\Role\RoleResource;
use App\Models\Generated\Year;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed first_name
 * @property mixed last_name
 * @property mixed email
 * @property mixed email_verified_at
 * @property mixed status
 * @property mixed roles
 * @property mixed blocked_reason
 * @property mixed phone
 * @property mixed languages
 * @property mixed uploaded_avatar
 * @property mixed avatar
 * @property mixed created_by_user
 * @property mixed updated_by_user
 * @property mixed mergeWhen
 * @property mixed created_at
 * @property mixed updated_at
 * @property mixed deleted_at
 * @method getAllPermissions()
 * @method family()
 */
class StudentRegistrationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $results = $this->results;
        $subject_registrations = $this->classroom->subject_registrations;
        $exams = [];
        $student_results = [];
        $total_subject = 0;
        $total = 0;
        foreach ($subject_registrations as $subject_registration) {
            foreach ($subject_registration->exams as $exam) {
                $result_value = $results->where('exam_id', $exam->id)->first()?->value??0;
                $exams[] = [
                    'exam_name' => $exam->type,
                    'exam_percentage' => $exam->percentage,
                    'result' => $result_value
                ];
                $total += $result_value * $exam->percentage / 100;
            }
            $student_results[] = [
                'subject_name' => $subject_registration->subject->name,
                'semester' => $subject_registration->subject->semester,
                'subject_percentage' => $subject_registration->percentage,
                'exams' => $exams,
                'total' => $total
            ];
            $total_subject += $total;
        }
        return [
            'no' => str_pad($this->id, 8, "0", STR_PAD_LEFT),
            'id' => $this->id,
            'student_id' => $this->student?->id,
            'student_no' => str_pad($this->student?->id, 8, "0", STR_PAD_LEFT),
            'student_name' => $this->student_name,
            'classroom_name' => $this->classroom?->name,
            'class_level_name' => $this->classroom?->class_level?->name,
            'results' => $student_results,
            'total_result' => $total_subject,
            'total_percentage' => $this->classroom->subject_registrations->sum('percentage'),
            'fee' => $this->fee(),
            'payments' => $this->total_payments(),
            'debt' => $this->debt(),
            'payments_data' => PaymentResource::collection($this->payments),
            "created_by" => $this->created_by_user?->name,
            "created_by_id" => $this->created_by_user?->id,
            "updated_by" => $this->updated_by_user?->name,
            "updated_by_id" => $this->updated_by_user?->id,
            $this->mergeWhen($this->created_at, [
                "created_at" => $this->created_at?->format("Y-m-d (h:i)A"),
                "created_from" => $this->created_at?->diffForHumans(),
            ]),
            $this->mergeWhen($this->updated_at, [
                "updated_at" => $this->updated_at?->format("Y-m-d (h:i)A"),
                "updated_from" => $this->updated_at?->diffForHumans(),
            ]),
            $this->mergeWhen($this->deleted_at, [
                "deleted_at" => $this->deleted_at?->format("Y-m-d (h:i)A"),
                "deleted_from" => $this->deleted_at?->diffForHumans(),
            ]),
        ];
    }
}
