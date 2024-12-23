package model

type Otp struct {
	ID
	TIMES

	Code   string `json:"code" gorm:"type:char(6); not null"`
	UserID string `json:"user_id" gorm:"type:varchar(36)"`

	User User `json:"user"`
}
