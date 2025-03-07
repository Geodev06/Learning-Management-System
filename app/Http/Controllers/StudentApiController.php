<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StudentApiController extends Controller
{
    protected $recommendEndPoint = 'https://mab-xkoj.onrender.com/students/recommend';
    protected $studentStatsEndPoint = 'https://mab-xkoj.onrender.com/students/stats';

    /**
     * Send request to recommendation endpoint
     */
    public function sendRecommendRequest()
    {
        $studentId = "student_" . Auth::user()->id;
        return $this->sendPostRequest($this->recommendEndPoint, $studentId);
    }

    /**
     * Send request to student stats endpoint
     */
    public function sendStudentStatsRequest()
    {
        $studentId = "student_" . Auth::user()->id;
        return $this->sendPostRequest($this->studentStatsEndPoint, $studentId);
    }

    /**
     * Private helper to send POST request with student_id
     *
     * @param string $url
     * @param string $studentId
     * @return mixed
     */
    private function sendPostRequest($url, $studentId)
    {
        $postData = [
            'studentId' => $studentId
        ];

        try {
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json'
            ]);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new \Exception('cURL Error: ' . curl_error($ch));
            }

            curl_close($ch);

            Log::info('POST Request Success', [
                'url' => $url,
                'student_id' => $studentId,
                'response' => $response,
            ]);

            return response()->json([
                'success' => true,
                'data' => json_decode($response, true)
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send POST request', [
                'url' => $url,
                'student_id' => $studentId,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to connect to external service.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
