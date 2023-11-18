<?php

interface Visitor {
    public function visitCompany(Company $company);
    public function visitDepartment(Department $department);
    public function visitEmployee(Employee $employee);
}

class SalaryReportVisitor implements Visitor {
    private $report = [];

    public function visitCompany(Company $company) {
        foreach ($company->getDepartments() as $department) {
            $department->accept($this);
        }
    }

    public function visitDepartment(Department $department) {
        foreach ($department->getEmployees() as $employee) {
            $employee->accept($this);
        }
    }

    public function visitEmployee(Employee $employee) {
        $this->report[] = [
            'name' => $employee->getName(),
            'position' => $employee->getPosition(),
            'salary' => $employee->getSalary()
        ];
    }

    public function getReport() {
        return $this->report;
    }
}

class Company {
    private $departments;

    public function __construct(array $departments) {
        $this->departments = $departments;
    }

    public function getDepartments() {
        return $this->departments;
    }

    public function accept(Visitor $visitor) {
        $visitor->visitCompany($this);
    }
}

class Department {
    private $employees;

    public function __construct(array $employees) {
        $this->employees = $employees;
    }

    public function getEmployees() {
        return $this->employees;
    }

    public function accept(Visitor $visitor) {
        $visitor->visitDepartment($this);
    }
}

class Employee {
    private $name;
    private $position;
    private $salary;

    public function __construct($name, $position, $salary) {
        $this->name = $name;
        $this->position = $position;
        $this->salary = $salary;
    }

    public function getName() {
        return $this->name;
    }

    public function getPosition() {
        return $this->position;
    }

    public function getSalary() {
        return $this->salary;
    }

    public function accept(Visitor $visitor) {
        $visitor->visitEmployee($this);
    }
}

$employees = [
    new Employee('John Doe', 'Developer', 5000),
    new Employee('Rosa Smith', 'Designer', 4000)
];

$department = new Department($employees);
$company = new Company([$department]);

$visitor = new SalaryReportVisitor();

$company->accept($visitor);

$report = $visitor->getReport();

print_r($report);

?>