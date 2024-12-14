package domain

import "time"

type CompanyPublic struct {
	ID
	TIMES

	Name     string `json:"name" gorm:"size:100; not null"`
	Location string `json:"location" gorm:"size:100"`
}

type CompanyPrivate struct {
	SubFrom time.Time `json:"sub_from"`
	SubTo   time.Time `json:"sub_to"`
}

type Company struct {
	CompanyPublic
	CompanyPrivate
}
