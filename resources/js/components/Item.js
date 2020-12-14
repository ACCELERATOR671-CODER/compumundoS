import React from 'react'
import './css/item.css'
class  Item extends React.Component{

        render(){
            return(
                <React.Fragment>
                    <div className="card Item-Card">
                        <div className="card-body">
                            <img src={"/images2/"+this.props.prod_img} width= "250px" height= "250px" className="float-rigth" alt="Baner 01"/>
                            <h5>{this.props.prod_name}</h5>
                            <h6>Precio: {this.props.prod_price}$</h6>
                            <a href={"productoN/"+this.props.prod_id} className="btn btn-primary" role="button">Ver</a>
                            
                       </div>

                    </div>
            </React.Fragment>);
        }
            
}

export default Item;
