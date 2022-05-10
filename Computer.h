#pragma once
#include "Item.h"
class Computer : public Item
{
	std::string m_cpu ;
	bool m_isLaptop;
public:
	//constractor
	Computer(const int price, const std::string manufacturer, const std::string cpu,const bool isLaptop);
	
	//set cpu name
	void setCpu(const std::string cpu);
	
	//return cpu
	std::string getCpu() const;

	//set if laptop -T\F
	void setIsLaptop(const bool isLaptop);

	//return is laptop
	bool getIsLaptop() const;

	//casting operator (to string)
	operator std::string() const;

	//destractor
	~Computer();
};