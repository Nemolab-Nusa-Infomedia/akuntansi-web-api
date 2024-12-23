package model

type UserCompanyPublic struct {
	ID
	TIMES

	CompanyID string `json:"company_id" gorm:"type:varchar(36)"`
	UserID    string `json:"user_id" gorm:"type:varchar(36)"`

	Company Company `json:"company"`
	User    User    `json:"user"`
}

type UserCompanyPrivate struct {
	Role string `json:"role" gorm:"size:100"`
}

type UserCompany struct {
	UserCompanyPublic
	UserCompanyPrivate
}
