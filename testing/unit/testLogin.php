<?php

use PHPUnit\Framework\TestCase;

// Import tài nguyên
require "sourceForTest.php";

// component testing
require "test_here.php";

class testLogin extends TestCase {
        // Chuẩn bị dữ liệu test
        protected $email_none = "";
        protected $email_false = "noneExists@gmail.com";
        protected $email_true = "501200018@stu.itc.edu.vn";

        protected $pass_none = "";
        protected $pass_false = "false-false-false";
        protected $pass_true = "12345678";

        // Test form Login
        function testCase1 () {
            $this->assertEquals(
                expected: false, 
                actual: login($this->email_none, $this->pass_none));
        }
        function testCase2 () {
            $this->assertEquals(
                expected: false, 
                actual: login($this->email_none, $this->pass_false));
        }
        function testCase3 () {
            $this->assertEquals(
                expected: false, 
                actual: login($this->email_none, $this->pass_true));
        }
        function testCase4 () {
            $this->assertEquals(
                expected: false, 
                actual: login($this->email_false, $this->pass_none));
        }
        function testCase5 () {
            $this->assertEquals(
                expected: false, 
                actual: login($this->email_false, $this->pass_false));
        }
        function testCase6 () {
            $this->assertEquals(
                expected: false, 
                actual: login($this->email_false, $this->pass_true));
        }
        function testCase7 () {
            $this->assertEquals(
                expected: false, 
                actual: login($this->email_true, $this->pass_none));
        }
        function testCase8 () {
            $this->assertEquals(
                expected: false, 
                actual: login($this->email_true, $this->pass_false));
        }
        function testCase9 () {
            $this->assertEquals(
                expected: false, 
                actual: login($this->email_true, $this->pass_true));
        }
       
    }